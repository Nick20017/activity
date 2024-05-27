<?php

class Activity {
    private array $json = [];

    public function __construct(array $json) {
        $this->json = $json;
    }

    public function setJson(array $json) {
        $this->json = $json;
    }

    public function getRandomActivities(): array|null {
        $activityAmount = count($this->json);

        switch($activityAmount) {
            case 0:
                return [];
            case 1:
                return [$this->json[0]];
            default:
                $selectedIndices = [];
                $items = [];
                while(count($selectedIndices) < min($activityAmount, 3)) {
                    $randomActivityIndex = rand(0, $activityAmount - 1);
                    if (in_array($randomActivityIndex, $selectedIndices)) continue;

                    $items[] = $this->json[$randomActivityIndex];

                    $selectedIndices[] = $randomActivityIndex;
                }

                return $items;
        }
    }
}