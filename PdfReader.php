<?php

declare(strict_types=1);

namespace Matleo\BankStatementParserBundle;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

final class PdfReader
{
    private const LINE_DELIMITER = PHP_EOL;

    /**
     * @var string
     */
    private $tmpPath;

    public function __construct()
    {
        $this->tmpPath = sys_get_temp_dir();
    }

    /**
     * @param string $fileNameWithPath
     *
     * @return array
     *
     * @throws \Exception
     */
    public function execute(string $fileNameWithPath) : array
    {
        $tmpPath = $this->tmpPath.'/'. random_int(0, 10000).'.txt';
        $process = new Process(['/usr/bin/pdftotext','-layout' , $fileNameWithPath , $tmpPath]);

        $process->run(static function($type, $buffer) {});

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $content = $this->parse($tmpPath);

        unlink($tmpPath);

        return $content;
    }


    private function parse(string $textVersionPath) : array
    {
        $txt_file = file_get_contents($textVersionPath);

        return explode(self::LINE_DELIMITER, $txt_file);
    }
}