<?php

namespace App\Helpers;

use LogicException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;

class FlashToSessionHelpers
{
    const KEY_FLASH_ERROR = 'error';

    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $notice
     * @return void
     */
    private function addFlashError(
        string $notice
    ): void {
        $this->addFlash(self::KEY_FLASH_ERROR, $notice);
    }

    /**
     * Adds a flash message to the current session for type.
     *
     * @throws LogicException
     */
    protected function addFlash(string $type, $message): void
    {
        try {
            $this->container->get('request_stack')->getSession()->getFlashBag()->add($type, $message);
        } catch (SessionNotFoundException $e) {
            throw new LogicException('You cannot use the addFlash method if sessions are disabled. Enable them in "config/packages/framework.yaml".', 0, $e);
        }
    }
}