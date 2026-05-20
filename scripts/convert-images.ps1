# Convert images to WebP for improved performance
# Tries ImageMagick `magick` first, then `cwebp` if available.
param()

$src = "public/images/bg-gym.jpg"
$dest = "public/images/bg-gym.webp"

if (!(Test-Path $src)) {
    Write-Host "Source image not found: $src" -ForegroundColor Red
    exit 1
}

function Run-Magick {
    Write-Host "Attempting conversion with ImageMagick (magick)..."
    $cmd = "magick convert `"$src`" -quality 80 `"$dest`""
    try {
        iex $cmd
        return $LASTEXITCODE -eq 0
    } catch {
        return $false
    }
}

function Run-Cwebp {
    Write-Host "Attempting conversion with cwebp..."
    $cmd = "cwebp -q 80 `"$src`" -o `"$dest`""
    try {
        iex $cmd
        return $LASTEXITCODE -eq 0
    } catch {
        return $false
    }
}

if (Run-Magick) {
    Write-Host "Converted to WebP using ImageMagick: $dest" -ForegroundColor Green
    exit 0
}

if (Run-Cwebp) {
    Write-Host "Converted to WebP using cwebp: $dest" -ForegroundColor Green
    exit 0
}

Write-Host "Neither 'magick' nor 'cwebp' were available. Install ImageMagick or the WebP tools, or use an npm package like 'sharp' to convert images." -ForegroundColor Yellow
Write-Host "Suggested commands:" -ForegroundColor Cyan
Write-Host "  choco install imagemagick" -ForegroundColor Gray
Write-Host "  npm install --global sharp-cli" -ForegroundColor Gray
Write-Host "Or run locally: npx sharp-cli public/images/bg-gym.jpg public/images/bg-gym.webp" -ForegroundColor Gray
exit 1
