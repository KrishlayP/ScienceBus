param(
    [string]$ProjectRoot = (Split-Path -Parent $PSScriptRoot)
)

$ErrorActionPreference = 'Stop'
$outputRoot = Join-Path $ProjectRoot 'dist\infinityfree'
$htdocsRoot = Join-Path $outputRoot 'htdocs'
$dumpPath = Join-Path $outputRoot 'sciencebus.sql'
$mysqldump = 'C:\xampp\mysql\bin\mysqldump.exe'

if (Test-Path $outputRoot) {
    Remove-Item -LiteralPath $outputRoot -Recurse -Force
}

New-Item -ItemType Directory -Path $htdocsRoot -Force | Out-Null

$excludedDirectories = @('.git', 'deployment', 'dist')
$excludedFiles = @('debug.php', 'sql.php', 'database.sql', 'infinityfree-import.sql', 'infinityfree-current.sql')

$robocopyArgs = @(
    $ProjectRoot,
    $htdocsRoot,
    '/E',
    '/R:1',
    '/W:1',
    '/NFL',
    '/NDL',
    '/NJH',
    '/NJS',
    '/XD'
) + ($excludedDirectories | ForEach-Object { Join-Path $ProjectRoot $_ }) + @('/XF') + $excludedFiles

& robocopy @robocopyArgs | Out-Null
if ($LASTEXITCODE -gt 7) {
    throw "Robocopy failed with exit code $LASTEXITCODE."
}

if (-not (Test-Path $mysqldump)) {
    throw "mysqldump was not found at $mysqldump."
}

& $mysqldump `
    --host=127.0.0.1 `
    --port=3306 `
    --user=root `
    --default-character-set=utf8mb4 `
    --single-transaction `
    --skip-add-locks `
    --skip-comments `
    --no-create-db `
    --result-file=$dumpPath `
    sciencebus

if ($LASTEXITCODE -ne 0) {
    throw "Database export failed with exit code $LASTEXITCODE."
}

Write-Host "InfinityFree package created at $outputRoot"
