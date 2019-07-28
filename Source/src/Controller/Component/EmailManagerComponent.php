<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Routing\Router;

class EmailManagerComponent extends Component
{
    public function sendConfirmationEmail($toEmail, $confirmLink)
    {
    	$from = new \SendGrid\Email(null, 'info@unidepartment.com');
        $subject = __('{0} - Επιβεβαίωση Λογαριασμού', Configure::read('department.name'));
        $to = new \SendGrid\Email(null, $toEmail);
        $content = new \SendGrid\Content('text/plain', __('Παρακαλώ ακολουθήστε το παρακάτω link για την επιβεβαίωση του λογαριασμού σας: {0}', Router::url(['controller' => 'users', 'action' => 'confirm', 'id' => $confirmLink], true)));
        $mail = new \SendGrid\Mail($from, $subject, $to, $content);

        $sg = new \SendGrid(Configure::read('sendgrid.api-key'));

        $response = $sg->client->mail()->send()->post($mail);

        \Cake\Log\Log::write('error', $response);
    }

    public function sendPasswordRestoreEmail($toEmail, $restoreLink)
    {
        $from = new \SendGrid\Email(null, 'info@unidepartment.com');
        $subject = __('{0} - Ανάκτηση Κωδικού', Configure::read('department.name'));
        $to = new \SendGrid\Email(null, $toEmail);
        $content = new \SendGrid\Content('text/plain', __('Παρακαλώ ακολουθήστε το παρακάτω link για την ανάκτηση του κωδικού σας: {0}', Router::url(['controller' => 'users', 'action' => 'restorePassword', 'id' => $restoreLink], true)));
        $mail = new \SendGrid\Mail($from, $subject, $to, $content);

        $sg = new \SendGrid(Configure::read('sendgrid.api-key'));

        $response = $sg->client->mail()->send()->post($mail);
    }
}