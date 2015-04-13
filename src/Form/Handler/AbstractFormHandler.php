<?php

namespace Piwi\Form\Handler;

use Piwi\Form\Exception\ValidationException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Abstract form handler
 *
 * @package Piwi\Model\Form\Handler
 */
abstract class AbstractFormHandler implements FormHandlerInterface
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var FormTypeInterface
     */
    protected $formType;

    /**
     * @param FormFactoryInterface $formFactory
     * @param FormTypeInterface $formType
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        FormTypeInterface $formType
    ) {
        $this->formFactory = $formFactory;
        $this->formType = $formType;
    }

    /**
     * {@inheritdoc}
     */
    public function form($data = null, array $options = [])
    {
        return $this->formFactory->create($this->formType, $data, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function process(FormInterface $form, Request $request)
    {
        // Handle the request
        $form->handleRequest($request);
    }

    /**
     * Create validation exception
     *
     * @param FormInterface $form
     *
     * @return ValidationException
     */
    protected function createValidationException(FormInterface $form)
    {
        return new ValidationException($form->getName());
    }
}