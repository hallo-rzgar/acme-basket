# Acme Basket – ThriveCart Code Test

This is a simple PHP-based shopping basket system for Acme Widget 
It calculates the total cost of an order based on product prices, special offers, and delivery costs.


## Features

- **Product Catalog**: Includes Red, Green, and Blue widgets.
- **Delivery Charges**: Based on the order total:
   - $4.95 for orders under $50
   - $2.95 for orders under $90
   - Free delivery for orders over $90
- **Special Offer**: "Buy one Red Widget, get the second one at half price."
- **Unit Testing**: All features are thoroughly tested with PHPUnit.
- **Code Quality**: Static analysis with PHPStan ensures clean, maintainable code.


## Technologies Used

- PHP 8.3
- Composer for dependency management
- PHPUnit for testing
- PHPStan for static analysis
- Docker for environment setup (optional)


## Getting Started

### With Docker (optional)

1. Clone the repository and navigate to the project folder:

   ```bash
   git clone https://github.com/hallo-rzgar/acme-basket.git
   cd acme-basket
   ```

2. Build the Docker container:

   ```bash
   docker-compose build
   ```

3. Install dependencies:

   ```bash
   docker-compose run --rm php composer install
   ```

4. Run tests:

   ```bash
   docker-compose run --rm php vendor/bin/phpunit
   ```

5. Run static analysis with PHPStan:

   ```bash
   docker-compose run --rm php vendor/bin/phpstan analyse
   ```

### Without Docker (Locally)

If you prefer to run the project locally, follow these steps:

1. Clone the repository and install dependencies:

   ```bash
   git clone https://github.com/hallo-rzgar/acme-basket.git
   cd acme-basket
   composer install
   ```

2. Run tests:

   ```bash
   vendor/bin/phpunit
   ```

3. Run static analysis with PHPStan:

   ```bash
   vendor/bin/phpstan analyse
   ```


## Code Overview

The `Basket` class is responsible for:
- Adding products to the basket.
- Calculating the total cost, applying any offers, and determining delivery charges.

The `BuyOneGetOneHalfOffOffer` class implements the "Buy one Red Widget, get the second one at half price" discount logic.


## Author
Hallo Rizgar