<?php

namespace Ninja;

interface Website
{
    public function getDefaultRoute(): string;
    public function getController(string $controller_name): ?object;
    public function checkLogin(string $uri): ?string;
    public function getLayoutVariables(): array;
}
