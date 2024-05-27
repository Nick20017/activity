<?php

class Activity {
    private array $json = [];

    public function __construct(array $json) {
        $this->json = $json;
    }

    public function setJson(array $json) {
        $this->json = $json;
    }

    public function getRandomActivity(): array|null {
        $activityAmount = count($this->json);

        switch($activityAmount) {
            case 0:
                return null;
            case 1:
                return $this->json[0];
            default:
                $randomActivityIndex = rand(0, $activityAmount - 1);
                return $this->json[$randomActivityIndex];
        }
    }
}