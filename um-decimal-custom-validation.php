<?php
/**
 * Plugin Name:         Ultimate Member - Decimal Custom Validation
 * Description:         Extension to Ultimate Member for validating decimal text values.
 * Version:             1.0.0
 * Requires PHP:        7.4
 * Author:              Miss Veronica
 * License:             GPL v3 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Author URI:          https://github.com/MissVeronica
 * Text Domain:         ultimate-member
 * Domain Path:         /languages
 * UM version:          2.8.5
 */

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'UM' ) ) return;

class UM_Decimal_Custom_Validation {

    function __construct() {

        add_filter( 'um_change_usermeta_for_update',              array( $this, 'um_before_save_filter_decimal_balance' ), 10, 4);
        add_action( 'um_custom_field_validation_decimal_balance', array( $this, 'um_custom_validate_decimal_balance' ), 30, 3 );
    }

    public function um_before_save_filter_decimal_balance( $to_update, $args, $fields, $key ) {

        if ( isset( $fields[$key]['custom_validate'] ) && $fields[$key]['custom_validate'] == 'decimal_balance' ) {

            if ( isset( $to_update[$key] )) {

                $to_update[$key] = ltrim( trim( str_replace( '.', ',', $to_update[$key] )), '0' );

                if ( strlen( $to_update[$key] ) == 0 ) {
                    $to_update[$key] = '0,00';
                }

                if ( strpos( $to_update[$key], ',' ) !== false ) {

                    $values = explode( ',', $to_update[$key] );

                    if ( strlen( $values[0] ) == 0 ) {
                        $values[0] = '0';
                    }

                    $to_update[$key] = $values[0] . ',';
                    $decimals = strlen( $values[1] );

                    switch( $decimals ) {
                        case 0:     $to_update[$key] .= '00';                       break;
                        case 1:     $to_update[$key] .= $values[1] . '0';           break;
                        case 2:     $to_update[$key] .= $values[1];                 break;
                        default:    $to_update[$key] .= substr( $values[1], 0, 2 ); break;
                    }

                } //else $to_update[$key] .= ',00';
            }
        }

        return $to_update;
    }

    public function um_custom_validate_decimal_balance( $key, $array, $args ) {

        if ( isset( $args[$key] )) {

            $value = trim( str_replace( '.', ',', $args[$key] ));

            if ( strlen( $value ) == 0 ) {

                UM()->form()->add_error( $key, __( 'Please enter a valid Decimal Balance number.', 'ultimate-member' ) );
            }

            $digits = true;

            if ( strpos( $value, ',' ) !== false ) {

                $values = explode( ',', $value );

                if ( count( $values ) > 2 ) {

                    UM()->form()->add_error( $key, __( 'Please enter a valid Decimal Balance number with none or one decimal point.', 'ultimate-member' ) );
                }

                if ( strlen( $values[0] > 0 ) && ! ctype_digit( $values[0] )) {
                    $digits = false;
                }

                if ( strlen( $values[1] > 0 ) && ! ctype_digit( $values[1] )) {
                    $digits = false;
                }

            } else {

                if ( ! ctype_digit( $value )) {
                    $digits = false;
                }
            }

            if ( ! $digits ) {

                UM()->form()->add_error( $key, __( 'Please enter a valid Decimal Balance number with digits.', 'ultimate-member' ) );
            }
        }
    }


}

new UM_Decimal_Custom_Validation();
