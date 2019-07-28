<?php
namespace App\Model\Entity;

class SaveException extends \Exception
{
    private $rawErrors;

    public function __construct($message, $errors, Exception $previous = null) {
        $this->rawErrors = [$message];

        foreach ($errors as $field => $error) {
            foreach ($error as $code => $msg) {
                $this->rawErrors[] = $msg;
            }
        }

        parent::__construct($message, 0, $previous);
    }

    public function getModelErrors() {
        return $this->rawErrors;
    }
}