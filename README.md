# SPOJ POUR1 - Pouring Water Solution

A professional PHP implementation of the [SPOJ POUR1](https://www.spoj.com/problems/POUR1/cstart=20) problem, designed to demonstrate modern software engineering practices.

## 🚀 Overview

This repository provides two ways to run the solution:

1. **Standalone Version**: A single-file script optimized for direct evaluation or competitive programming environments.
2. **Structured Version**: A modular, PSR-4 compliant architecture designed for testability and long-term maintenance.

## 🛠 Project Structure

- standalone.php - **Single-file solution** (Logic + I/O combined).
- src/ - **Modular source code**:
  - Solver/ - Core algorithmic logic (decoupled from I/O).
  - Math/ - Reusable mathematical utilities (GCD).
  - IO/ - Input/Output handling.
- tests/ - **Unit Test suite** utilizing PHPUnit 12.
- structured.php - Entry point for the structured version.

## 📋 Requirements

- **PHP** 8.2 or higher
- **Composer** (for running the structured version and tests)

## ⚙️ Installation & Usage

### Standalone Version

Run the single-file solution directly without any dependencies:

```bash
php standalone.php
```

### Structured Version

Install dependencies via Composer and run the index script:

```bash
composer install
php structured.php
```

### Running Unit Tests

The project features a comprehensive test suite covering standard cases, impossible scenarios, and edge cases.

```bash
./vendor/bin/phpunit
```
