<?php
// visits.php
$file = __DIR__ . '/visits.txt';

// Считываем текущий счётчик (если нет — считаем 0)
$count = file_exists($file) ? (int)file_get_contents($file) : 0;

// Увеличиваем «общий»
$total = $count + 1;
file_put_contents($file, $total);

// Для «уникальных» можно использовать куки:
$cookieName = 'zemkom_unique';
if (!isset($_COOKIE[$cookieName])) {
    setcookie($cookieName, '1', time() + 3600*24*365);
    $uniqueFile = __DIR__ . '/unique.txt';
    $uniq = file_exists($uniqueFile) ? (int)file_get_contents($uniqueFile) + 1 : 1;
    file_put_contents($uniqueFile, $uniq);
} else {
    $uniq = (int)file_get_contents(__DIR__ . '/unique.txt');
}

header('Content-Type: application/json');
echo json_encode(['total' => $total, 'unique' => $uniq]);
