<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Routing\Router;

class UploadCheckerComponent extends Component
{
    public function throwIfError($file)
    {
        if (!array_key_exists('error', $file)) {
            return;
        }

        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
                throw new \Exception(__('Το αρχείο {0} ξεπερνάει το μέγιστο αρχείο που μπορεί να δεχθεί ο server', $file['name']));
                break;
            case UPLOAD_ERR_FORM_SIZE:
                throw new \Exception(__('Το αρχείο {0} ξεπερνάει το μέγιστο αρχείο που μπορεί να δεχθούν οι φόρμες', $file['name']));
                break;
            case UPLOAD_ERR_PARTIAL:
                throw new \Exception(__('Το αρχείο {0} ανέβηκε μερικώς', $file['name']));
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new \Exception(__('Δεν επιλέχθηκε αρχείο'));
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
            case UPLOAD_ERR_CANT_WRITE:
            case UPLOAD_ERR_EXTENSION:
                throw new \Exception(__('Ένα εσωτερικό πρόβλημα δεν άφησε το αρχείο να ανέβει. Προσπαθήστε αργότερα'));
                break;
            default:
            case UPLOAD_ERR_OK:
                break; // no error
        }
    }
}