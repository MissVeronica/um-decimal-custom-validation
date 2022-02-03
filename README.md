# UM Decimal Custom Validation
Custom Validation of Decimal values

## Validation rules
Dot replaced by comma without user error message.

Valid decimal digits are only allowed.

Max one decimal point allowed.

Blanks are not allowed between digits.
## Formatting rules
When validation rules are finished and accepted additional formatting is added to the user input.

Leading zero removal.

Decimal point values are truncated to two digits after decimal point or padded with zero.

Values without a decimal point are left without decimals.

### Test cases Formatting Rules
125 > 125

000125 > 125

125,2 > 125,20

125, > 125,00

000125,2 > 125,20

125,24 > 125,24

123456,25689742 > 123456,25

123456,25333 > 123456,25

125.24 > 125,24

## UM Forms Designer implementation

Create the Form Fields as "Text Box" and enter your meta_key names and title/label etc.

Set "Validate" to "Custom Validation" for each Form Field

Set "Custom Action" to "decimal_balance"

## Installation
Add the code snippet source.php to your child-theme's functions.php file or add to the “Code Snippets” plugin

## References
https://docs.ultimatemember.com/article/94-apply-custom-validation-to-a-field

https://wordpress.org/plugins/code-snippets/
