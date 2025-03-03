# Build a Supplier Product List Processor

#### Requirement:

We have multiple different formats of files that need to be parsed and returned back as a Product object with all the headings as mapped properties.

Each product object constitutes a single row within the csv file.

#### Example Application API:
The Processor can also convert from one format to another.
By using the `-v` flag we can enable verbose logging to display performance metrics.

`parser.php --file 'examples/products_comma_separated.csv' --unique-combinations=combination_count.csv`

`parser.php --file 'examples/products_tab_separated.tsv' --unique-combinations=combination_count.csv`

`parser.php --file 'examples/products_comma_separated.csv' --unique-combinations=combination_count.tsv -v`

When the above is run the parser should display row by row each product object representation of the row. And create a file with a grouped count for each unique combination i.e. make, model, colour, capacity, network, grade, condition.

#### Example Product Object:
- make: 'Apple' (string, required) - Brand name
- model: 'iPhone 6s Plus' (string, required) - Model name
- colour: 'Red' (string) - Colour name
- capacity: '256GB' (string) - GB Spec name
- network: 'Unlocked' (string) - Network name
- grade: 'Grade A' (string) - Grade Name
- condition: 'Working' (string) - Condition name

#### Example Unique Combinations File:
- make: 'Apple'
- model: 'iPhone 6s Plus'
- colour: 'Red'
- capacity: '256GB'
- network: 'Unlocked'
- grade: 'Grade A'
- condition: 'Working'
- count: 129

#### Things to note:
- Implement Design Patterns, adhere to OOP principles, incorporate DI (Dependency Injection), and follow SOLID principles where possible in your test submission.
- New formats could be introduced in the future ie. (json, xml etc).
- File headings could change in the future.
- Some files can be very large so watch out for memory usage.
- The code should be executable from a terminal.
- Please provide brief read me describing how to run your application.
- PHP 7+ must be used.
- Should be built using native PHP and no third party libraries.
- Required fields if not found within file should throw an exception.
- You can use Composer to autoload files.


#### Bonus:
- Add unit/integration tests.

#### Running Tests:
`php tests/runTests.php`
