<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

class PrismaService
{
    private $basePath;

    public function __construct()
    {
        $this->basePath = base_path();
    }

    /**
     * Execute a Prisma query using Node.js
     */
    public function executeQuery($query, $method = 'findMany')
    {
        $script = "
const { PrismaClient } = require('@prisma/client');
const prisma = new PrismaClient();

async function main() {
    try {
        const result = await prisma.{$query}.{$method}();
        console.log(JSON.stringify(result, null, 2));
    } catch (error) {
        console.error('Error:', error);
        process.exit(1);
    } finally {
        await prisma.\$disconnect();
    }
}

main();
        ";

        $tempFile = tempnam(sys_get_temp_dir(), 'prisma_query_') . '.js';
        file_put_contents($tempFile, $script);

        $process = new Process(['node', $tempFile], $this->basePath);
        $process->run();

        unlink($tempFile);

        if (!$process->isSuccessful()) {
            Log::error('Prisma query failed: ' . $process->getErrorOutput());
            throw new \Exception('Prisma query failed: ' . $process->getErrorOutput());
        }

        return json_decode($process->getOutput(), true);
    }

    /**
     * Get all condominios with relations
     */
    public function getCondominios()
    {
        return $this->executeQuery('condominios', 'findMany({
            include: {
                blocos: true,
                imoveis: {
                    include: {
                        usuarios: true
                    }
                }
            }
        })');
    }

    /**
     * Get users by type
     */
    public function getUsuariosByTipo($tipo)
    {
        return $this->executeQuery("usuarios", "findMany({
            where: {
                tipo_pessoa: '{$tipo}'
            },
            include: {
                grupos: true,
                imoveis: {
                    include: {
                        condominios: true
                    }
                }
            }
        })");
    }

    /**
     * Get imoveis by condominio
     */
    public function getImoveisByCondominio($condominioId)
    {
        return $this->executeQuery("imoveis", "findMany({
            where: {
                condominio_id: '{$condominioId}'
            },
            include: {
                condominios: true,
                blocos: true,
                usuarios: true
            }
        })");
    }

    /**
     * Pull database schema
     */
    public function pullDatabase()
    {
        $process = new Process(['npx', 'prisma', 'db', 'pull'], $this->basePath);
        $process->run();

        return $process->isSuccessful();
    }

    /**
     * Generate Prisma client
     */
    public function generateClient()
    {
        $process = new Process(['npx', 'prisma', 'generate'], $this->basePath);
        $process->run();

        return $process->isSuccessful();
    }
}
