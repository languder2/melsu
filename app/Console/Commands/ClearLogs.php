<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:clear-logs';

    /**
     * @var string
     */
    protected $description = 'Очищает все лог-файлы в директории storage/logs.';

    public function handle()
    {
        $logFiles = File::glob(storage_path('logs') . '/*.log');

        if (empty($logFiles)) {
            $this->info('Лог-файлы не найдены. Очистка не требуется.');
            return 0;
        }

        foreach ($logFiles as $file) {
            file_put_contents($file, ''); // Очищаем содержимое файла
            $this->info('Очищен: ' . basename($file));
        }

        $this->info('Логи успешно очищены!');
        return 0;
    }
}
