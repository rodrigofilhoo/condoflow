<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class PrismaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prisma {action : The prisma action (generate, pull, push, studio)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute Prisma commands from Laravel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        
        $validActions = ['generate', 'pull', 'push', 'studio'];
        
        if (!in_array($action, $validActions)) {
            $this->error('Invalid action. Valid actions are: ' . implode(', ', $validActions));
            return 1;
        }

        $this->info("Executing Prisma {$action}...");

        $command = $action === 'studio' ? 
            ['npx', 'prisma', 'studio', '--port', '5556'] : 
            ['npx', 'prisma', 'db', $action];

        $process = new Process($command, base_path());
        $process->setTimeout(300); // 5 minutes timeout

        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                $this->error($buffer);
            } else {
                $this->info($buffer);
            }
        });

        if ($process->isSuccessful()) {
            $this->info("Prisma {$action} completed successfully!");
            
            if ($action === 'studio') {
                $this->info('Prisma Studio is running at http://localhost:5556');
            }
        } else {
            $this->error("Prisma {$action} failed with exit code: " . $process->getExitCode());
            return $process->getExitCode();
        }

        return 0;
    }
}
