<?php

namespace alejoluc\Validation;

class Validator {
    private $lang         = null;
    private $lang_default = 'en-us';
    private $stopAtFirstError;

    public function __construct(){
        $this->stopAtFirstError = false;
    }

    public function setLanguage($lang) {
        $this->lang = $lang;
    }

    public function setStopAtFirstError($stop = false) {
        $this->stopAtFirstError = $stop;
    }

    public function validate($data, $rules) {
        $lang   = $this->getLangArray();
        $result = new ValidationResult();
        foreach ($rules as $ruleField => $ruleRule) {
            $break = false;
            if (!isset($data[$ruleField])) {
                $data[$ruleField] = null;
            }
            if (is_array($ruleRule)) {
                foreach ($ruleRule as $actualRule) {
                    if ($actualRule->validate($data[$ruleField]) === false) {
                        $validator = $this->getClassName($actualRule);
                        $result->addError($ruleField, $actualRule->getErrorMessage($lang, $validator));
                        if ($this->stopAtFirstError === true) {
                            $break = true;
                            break;
                        }
                    }
                }
            } else {
                if ($ruleRule->validate($data[$ruleField]) === false) {
                    $validator =  $this->getClassName($ruleRule);
                    $result->addError($ruleField, $ruleRule->getErrorMessage($lang, $validator));
                    if ($this->stopAtFirstError === true) {
                        $break = true;
                    }
                }
            }
            if ($break === true) {
                break;
            }
        }
        return $result;
    }

    private function getClassName($object) {
        $fullName = get_class($object);
        $parts = explode("\\", $fullName);
        return $parts[(count($parts) - 1)];
    }

    private function getLangArray() {
        if ($this->lang == null) {
            $this->setLanguage($this->lang_default);
        }
        $langFile = __DIR__ . '/../lang/' . $this->lang . '.php';
        if (!file_exists($langFile)) {
            throw new \Exception("Language file $langFile does not exist");
        }
        $defaultLangFile =__DIR__ . '/../lang/' . $this->lang_default . '.php';
        $lang = array_merge(require $defaultLangFile, require $langFile);
        return $lang;
    }
}