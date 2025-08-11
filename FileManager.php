<?php
declare(strict_types=1);

class FileManager {
    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }

    public function read(): array {
        $content = file_get_contents($this->filePath);
        $data = json_decode($content, true);
        return is_array($data) ? $data : [];
    }

    public function write(array $data): bool {
        return (bool) file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
