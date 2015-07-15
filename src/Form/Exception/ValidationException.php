<?php

namespace Piwi\Form\Exception;
use Exception;
use Symfony\Component\Form\FormInterface;

/**
 * ValidationException if Form validation fails
 */
class ValidationException extends \Symfony\Component\Form\Exception\RuntimeException
{
    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @param FormInterface $form
     * @param int $code
     * @param Exception $previous
     */
    public function __construct(FormInterface $form, $code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf('The form \'%s\' is invalid', $form->getName()), $code, $previous);

        $this->form = $form;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }
}
