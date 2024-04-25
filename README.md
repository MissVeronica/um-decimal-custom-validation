# UM Decimal Custom Validation
Extension to Ultimate Member for Custom Validation of Decimal values

## UM Forms Designer Implementation
1. Create the Form Fields as "Text Box" and enter your meta_key names and title/label etc.
2. Set "Validate" to "Custom Validation" for each Form Field
3. Set "Custom Action" to "decimal_balance"

## Validation Rules
1. Dot replaced by comma without user error message.
2. Valid decimal digits are only allowed.
3. Max one decimal point allowed.
4. Blanks or non-digit characters are not allowed among digits.

### Test Cases Validation Rules
1. $1000 => Please enter a valid Decimal Balance number with digits.
2. 1000$ => Please enter a valid Decimal Balance number with digits.
3. 1000SEK => Please enter a valid Decimal Balance number with digits.
4. 1 000,00 => Please enter a valid Decimal Balance number with digits.
5. 1.000.000,00 => Please enter a valid Decimal Balance number with none or one decimal point.
6. 1000, 00 => Please enter a valid Decimal Balance number with digits.

## Formatting Rules
1. When validation rules are finished and accepted additional formatting is added to the user input.
2. Leading zero removal.
3. Decimal point values are truncated to two digits after decimal point or padded with zero.
4. Values without a decimal point are left without decimals except 0 which is saved as 0,00.

### Test Cases Formatting Rules
1. 125 => 125
2. 000125 => 125
3. 125,2 => 125,20
4. 125, => 125,00
5. 000125,2 => 125,20
6. 0,2 => 0,20
7. ,2 => 0,20
8. 0 => 0,00
9. 125,24 => 125,24
10. 123456,25689742 => 123456,25
11. 123456,25333 => 123456,25
12. 125.24 => 125,24

## References
https://docs.ultimatemember.com/article/94-apply-custom-validation-to-a-field

## Installation
1. Install by downloading the plugin ZIP file and install as a new Plugin, which you upload in WordPress -> Plugins -> Add New -> Upload Plugin.
2. Activate the Plugin

