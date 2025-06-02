# BinaryTool

A clean and efficient PHP library for binary data conversion, using the **Strategy** design pattern for automatic selection between small and large binary handlers. Supports both **pack/unpack** for native data sizes and **GMP-based** operations for arbitrary precision.

---
[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/mamdadDev2024/Binary)
## 🛠 Installation and Requirements

**Requirements:**

- PHP `>= 8.0`
- **GMP** extension (required for large number conversions)

Install via Composer:

```bash
composer require mamdadDev/binary-tool
```

---

## 🚀 Quick Start: Usage via Facade

```php
use mamdadDev\BinaryTool\Binary;

// Pack a 4-byte signed integer (little-endian)
$binary = Binary::pack(123456, 4, true, 'little');

// Unpack the binary data back to integer
$value = Binary::unpack($binary, 4, true, 'little');
```

Supports:

- Byte sizes: `1`, `2`, `4`, `8`, and arbitrary (GMP)
- Signed/Unsigned integers
- Little or Big endian formats

---

## 🧠 Strategy Pattern Architecture

This library uses two main strategies:

### 🔹 SmallBinaryConvertor

- Uses PHP’s native `pack()` and `unpack()` functions.
- Optimized for small numbers (1-8 bytes).
- See: [`SmallBinaryConvertor.php`](src/Strategies/SmallBinaryConvertor.php#L13-L25)

### 🔸 BigBinaryConvertor

- Uses PHP’s GMP extension for large integers.
- Supports unlimited precision.
- See: [`BigBinaryConvertor.php`](src/Strategies/BigBinaryConvertor.php#L16-L30)

### 📌 Automatic Selection

The `Binary` facade automatically chooses the correct strategy based on the byte size.

---

## ⚙️ Configuration Options

You can control behavior using the following options:

| Option         | Description                     | Example              |
|----------------|----------------------------------|----------------------|
| `$signed`      | `true` for signed values         | `true`               |
| `$endianness`  | `'little'` or `'big'`            | `'big'`              |
| `$byteSize`    | Number of bytes to encode/decode | `1`, `2`, `4`, `8`   |

Constructor signature (used internally by Binary facade):

```php
__construct(int $byteSize, bool $signed = true, string $endianness = 'little')
```

---

## 📚 Supported Formats (SmallBinaryConvertor)

| Byte Size | Signed Format | Unsigned Format | Endianness   |
|-----------|----------------|------------------|--------------|
| 1         | `c`             | `C`              | -            |
| 2         | `s`             | `v` / `n`        | Little/Big   |
| 4         | `l`             | `V` / `N`        | Little/Big   |
| 8         | `q`             | `P` / custom     | Little/Big   |

*See:* [`SmallBinaryConvertor.php`](src/Strategies/SmallBinaryConvertor.php#L29-L40)

---

## ❗ Error Handling

Unsupported byte sizes or invalid configurations will throw meaningful exceptions.

Example:

```php
// Throws: InvalidArgumentException: Unsupported byte size
Binary::pack(123456, 3);
```

Validation logic:

- Byte size must be one of: `1`, `2`, `4`, `8` or handled by GMP.
- Endianness must be `'little'` or `'big'`.

*See:* [`SmallBinaryConvertor.php`](src/Strategies/SmallBinaryConvertor.php#L44-L46)

---

## 🧪 Tests

Tests are organized into the following suites:

```
tests/
├── Unit/
│   ├── SmallBinaryConvertorTest.php
│   ├── BigBinaryConvertorTest.php
│   └── BinaryFacadeTest.php
├── Feature/
│   ├── EndianessTest.php
│   ├── SignedUnsignedTest.php
│   ├── ByteSizeValidationTest.php
│   └── StrategySelectionTest.php
└── Integration/
    └── FullWorkflowTest.php
```

Run tests:

```bash
vendor/bin/phpunit
```

---

## 🧩 Namespaces and Structure

The project uses:

- Namespace: `mamdadDev\BinaryTool`
- Clean separation of:
  - **Facade**: `Binary`
  - **Contracts**: Strategy interface
  - **Strategies**: `SmallBinaryConvertor`, `BigBinaryConvertor`

---

## 🤝 Contributing

Pull requests and feature ideas are welcome!

To contribute:

1. Fork the repo
2. Create your branch
3. Write/update tests
4. Submit PR

---

## 📄 License

This project is licensed under the **MIT License**.

---

## 📝 Notes

- Strategy is selected automatically based on byte size.
- GMP-powered conversion ensures support for large integers.
- Optimized for performance and clarity in binary operations.

---

Happy Hacking! 🚀