<?php
declare(strict_types=1);

class Student {
    private FileManager $fm;

    public function __construct() {
        $this->fm = new FileManager(DATA_PATH . '/students.json');
    }

    public function all(): array {
        return $this->fm->read();
    }

    public function find(int $id): ?array {
        foreach ($this->all() as $s) {
            if ((int)$s['id'] === $id) return $s;
        }
        return null;
    }

    private function nextId(array $students): int {
        $max = 0;
        foreach ($students as $s) {
            if ((int)$s['id'] > $max) $max = (int)$s['id'];
        }
        return $max + 1;
    }

    public function create(array $data): bool {
        $students = $this->all();
        $data['id'] = $this->nextId($students);
        $students[] = $data;
        return $this->fm->write($students);
    }

    public function update(int $id, array $data): bool {
        $students = $this->all();
        foreach ($students as &$s) {
            if ((int)$s['id'] === $id) {
                $s['name'] = $data['name'];
                $s['age'] = (int)$data['age'];
                $s['email'] = $data['email'];
                $s['course'] = $data['course'];
                return $this->fm->write($students);
            }
        }
        return false;
    }

    public function delete(int $id): bool {
        $students = $this->all();
        $filtered = array_filter($students, fn($s) => (int)$s['id'] !== $id);
        return $this->fm->write(array_values($filtered));
    }
}
