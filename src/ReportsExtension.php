<?php
namespace kingdomadvisors\reports;

/**
 * @author    Selvin Ortiz
 * @package   Reports
 * @since     0.1.0
 */
class ReportsExtension extends \Twig_Extension
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Reports';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('greetFilter', [$this, 'greet']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('greetFunction', [$this, 'greet']),
        ];
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function greet($text = '')
    {
        return 'Hello '.$text;
    }
}
