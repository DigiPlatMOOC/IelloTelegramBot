<?php
/**
 * Created by PhpStorm.
 * User: andrea
 * Date: 27/10/17
 * Time: 18.20
 */

abstract class ChainElement
{
    /**
     * @var $next ChainElement
     */
    private $next;

    function __construct()
    {
        $this->next = null;
    }

    /**
     * @var $next ChainElement
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * Go To Next Chain Element
     * @param $value
     */
    protected function handleNext($value)
    {
        if($this->next != null)
            $this->next->handle($value, $this->next->next);
        return;
    }

    public function handleValue($value)
    {
        $this->handle($value, $this->next);
    }

    /**
     * @var $value
     * @var $next ChainElement
     */
    abstract protected function handle($value, $next);
}