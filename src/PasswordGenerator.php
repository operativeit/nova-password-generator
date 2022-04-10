<?php

namespace OutOfOffice\PasswordGenerator;

use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class PasswordGenerator extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'password-generator';

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param NovaRequest $request
     * @param string      $requestAttribute
     * @param object      $model
     * @param string      $attribute
     * @return void
     */
    protected function fillAttributeFromRequest( NovaRequest $request, $requestAttribute, $model, $attribute )
    {
        if ( $request->exists( $requestAttribute ) ) {
            $model->{$attribute} = Hash::make( $request[ $requestAttribute ] );
        }
    }

    /**
     * Fill password field with generated password when creating resource.
     *
     * @param bool $enabled
     * @return PasswordGenerator
     */
    public function fillOnCreate( bool $enabled = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'fillOnCreate' => $enabled,
        ] );
    }

    /**
     * Fill password field with generated password when updating resource.
     *
     * @param bool $enabled
     * @return PasswordGenerator
     */
    public function fillOnUpdate( bool $enabled = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'fillOnUpdate' => $enabled,
        ] );
    }

    /**
     * Set the length of the generated password.
     *
     * @param int $length
     * @return PasswordGenerator
     */
    public function length( int $length = 16 ): PasswordGenerator
    {
        return $this->withMeta( [
            'passwordLength' => $length,
        ] );
    }

    /**
     * Set the minimum length of the generated password.
     *
     * @param int $minLength
     * @return PasswordGenerator
     */
    public function minLength( int $minLength = 8 ): PasswordGenerator
    {
        return $this->withMeta( [
            'passwordMin' => $minLength,
        ] );
    }

    /**
     * Set the maximum length of the generated password.
     *
     * @param int $maxLength
     * @return PasswordGenerator
     */
    public function maxLength( int $maxLength = 128 ): PasswordGenerator
    {
        return $this->withMeta( [
            'passwordMax' => $maxLength,
        ] );
    }

    /**
     * Set the total length of the generated password
     * respecting the prefix and suffix/postfix.
     *
     * @param int $length
     * @return PasswordGenerator
     */
    public function totalLength( int $length = 24 ): PasswordGenerator
    {
        return $this->withMeta( [
            'passwordTotalLength' => $length,
        ] );
    }

    /**
     * Set the step increment of the generated password.
     *
     * @param int $lengthSteps
     * @return PasswordGenerator
     */
    public function lengthIncrementSteps( int $lengthSteps = 4 ): PasswordGenerator
    {
        return $this->withMeta( [
            'passwordIncrementSteps' => $lengthSteps,
        ] );
    }

    /**
     * Exclude similar characters in password charlist.
     * e.g. "i, l, 1, L, o, 0, O"
     *
     * @param bool $exclude
     * @return PasswordGenerator
     */
    public function excludeSimilar( bool $exclude = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'excludeSimilar' => $exclude,
        ] );
    }

    /**
     * Include similar characters in password charlist.
     * e.g. "i, l, 1, L, o, 0, O"
     *
     * @param bool $include
     * @return PasswordGenerator
     */
    public function includeSimilar( bool $include = true ): PasswordGenerator
    {
        return $this->excludeSimilar( !$include );
    }

    /**
     * Exclude ambiguous symbols in password charlist.
     * e.g. "{ } [ ] ( ) / \ ' " ` ~ , ; : . < >"
     *
     * @param bool $exclude
     * @return PasswordGenerator
     */
    public function excludeAmbiguous( bool $exclude = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'excludeAmbiguous' => $exclude,
        ] );
    }

    /**
     * Include ambiguous symbols in password charlist.
     * e.g. "{ } [ ] ( ) / \ ' " ` ~ , ; : . < >"
     *
     * @param bool $include
     * @return PasswordGenerator
     */
    public function includeAmbiguous( bool $include = true ): PasswordGenerator
    {
        return $this->excludeAmbiguous( !$include );
    }

    /**
     * Disable password hiding by default.
     *
     * @param bool $show
     * @return PasswordGenerator
     */
    public function showPassword( bool $show = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'showPassword' => $show,
        ] );
    }

    /**
     * Enable password hiding by default.
     *
     * @param bool $hide
     * @return PasswordGenerator
     */
    public function hidePassword( bool $hide = true ): PasswordGenerator
    {
        return $this->showPassword( !$hide );
    }

    /**
     * Whether to regenerate the password when an option is toggled.
     *
     * @param bool $enabled
     * @return PasswordGenerator
     */
    public function regenerateOnToggle( bool $enabled = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'regenerateOnToggle' => $enabled,
        ] );
    }

    /**
     * Add prefix to the generated passwords.
     *
     * @param string $prefix
     * @return PasswordGenerator
     */
    public function prefix( string $prefix = '' ): PasswordGenerator
    {
        return $this->withMeta( [
            'passwordPrefix' => $prefix,
        ] );
    }

    /**
     * Add suffix to the generated passwords.
     *
     * @param string $suffix
     * @return PasswordGenerator
     */
    public function suffix( string $suffix = '' ): PasswordGenerator
    {
        return $this->withMeta( [
            'passwordSuffix' => $suffix,
        ] );
    }

    /**
     * Add suffix to the generated passwords.
     *
     * @param string $postfix
     * @return PasswordGenerator
     */
    public function postfix( string $postfix = '' ): PasswordGenerator
    {
        return $this->suffix( $postfix );
    }

    /**
     * Whether lowercase characters should be enabled by default.
     *
     * @param bool $enabled
     * @return PasswordGenerator
     */
    public function lowercase( bool $enabled = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'lowercaseToggled' => $enabled,
        ] );
    }

    /**
     * Whether uppercase characters should be enabled by default.
     *
     * @param bool $enabled
     * @return PasswordGenerator
     */
    public function uppercase( bool $enabled = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'uppercaseToggled' => $enabled,
        ] );
    }

    /**
     * Whether numbers characters should be enabled by default.
     *
     * @param bool $enabled
     * @return PasswordGenerator
     */
    public function numbers( bool $enabled = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'numbersToggled' => $enabled,
        ] );
    }

    /**
     * Whether symbols characters should be enabled by default.
     *
     * @param bool $enabled
     * @return PasswordGenerator
     */
    public function symbols( bool $enabled = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'symbolsToggled' => $enabled,
        ] );
    }

    /**
     * Hide show password toggle in password field ui.
     *
     * @param bool $hide
     * @return PasswordGenerator
     */
    public function hideShowPasswordToggle( bool $hide = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'hideShowPasswordToggle' => $hide,
        ] );
    }

    /**
     * Hide password options toggles in password field ui.
     *
     * @param bool $hide
     * @return PasswordGenerator
     */
    public function hideOptionsToggles( bool $hide = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'hideOptionsToggles' => $hide,
        ] );
    }

    /**
     * Hide password length input in password field ui..
     *
     * @param bool $hide
     * @return PasswordGenerator
     */
    public function hideLengthInput( bool $hide = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'hidePasswordLengthInput' => $hide,
        ] );
    }

    /**
     * Hide copy password button in password field ui.
     *
     * @param bool $hide
     * @return PasswordGenerator
     */
    public function hideCopyPasswordButton( bool $hide = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'hideCopyPasswordButton' => $hide,
        ] );
    }

    /**
     * Hide regenerate password button in password field ui.
     *
     * @param bool $hide
     * @return PasswordGenerator
     */
    public function hideRegenerateButton( bool $hide = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'hideRegenerateButton' => $hide,
        ] );
    }

    /**
     * Hide copy password button in password field ui.
     *
     * @param bool $hide
     * @return PasswordGenerator
     */
    public function hideAllExtras( bool $hide = true ): PasswordGenerator
    {
        return $this->withMeta( [
            'hideShowPasswordToggle'  => $hide,
            'hideOptionsToggles'      => $hide,
            'hidePasswordLengthInput' => $hide,
            'hideCopyPasswordButton'  => $hide,
            'hideRegenerateButton'    => $hide,
        ] );
    }
}