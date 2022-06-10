<?php


class Response {
    private string $type;
    private string $headerLocation;
    private string $errorMessage;
    private View $view;

    public function __construct(string $type, string $headerLocation, string $errorMessage = NULL, View $view = NULL) {
        $this->type = $type;
        $this->headerLocation = $headerLocation;
        if ($errorMessage)
            $this->errorMessage = $errorMessage;
        if ($view)
            $this->view = $view;
    }

    public function getResponse() {

        if ($this->type == "View") {
            return $this->view;
        }

        if ($this->type == "Header") {
            header("Location: " . $this->headerLocation);
            exit();
        }

        if ($this->type == "Error") {
            echo $this->errorMessage;
        }

    }
}