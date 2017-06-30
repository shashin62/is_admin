<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Core\Configure;

class CommonComponent extends Component {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->Users = TableRegistry::get('Users');
        $this->EmailHashtags = TableRegistry::get('EmailHashtags');
    }

    public function sendMail($to, $subject, $body, $cc = [], $bcc = ['milind.dalvi14@gmail.com']) {

        $email = new Email('default');
        $email->domain('www.v2solutions.com');
        $email->emailFormat('html');

        $email->from([Configure::read()['EMAIL_FROM_ADDRESS'] => Configure::read()['EMAIL_FROM_NAME']]);
        $email->subject($subject);
        // see https://book.cakephp.org/3.0/en/core-libraries/email.html for more details
        if (is_array($to)) {

            $count = 0;
            foreach ($to as $key => $value) {
                if ($count == 0) {
                    $email->to($value);
                } else {
                    $email->addTo($value);
                }
                $count++;
            }
        } else {
            $email->to($to);
        }
        if (is_array($cc)) {
            $count = 0;
            foreach ($cc as $key => $value) {
                if ($count == 0) {
                    $email->cc($value);
                } else {
                    $email->addCc($value);
                }
                $count++;
            }
        } else {
            $email->cc($cc);
        }
        if (is_array($bcc)) {
            $count = 0;
            foreach ($bcc as $key => $value) {
                if ($count == 0) {
                    $email->bcc($value);
                } else {
                    $email->addBcc($value);
                }
                $count++;
            }
        } else {
            $email->bcc($bcc);
        }
        $email->send($body);
        return $email;
    }

    public function toastErrorMessages($errors) {
        $error_msg = [];
        foreach ($errors as $errors) {
            if (is_array($errors)) {
                foreach ($errors as $error) {
                    $error_msg[] = $error;
                }
            } else {
                $error_msg[] = $errors;
            }
        }

        if (!empty($error_msg)) {
            return implode("<br>", $error_msg);
        }
    }

    public function combineToSelect($result_set, $id_column, $value_column) {
        $result = [];
        foreach ($result_set as $value) {
            $result[$value[$id_column]] = $value[$value_column];
        }
        return $result;
    }

    public function replaceEmailHashtags($content, $user_id = null) {
        if ($user_id != null) {
            $user_data = $this->Users->find('all')->where(['id' => $user_id])->toArray();
            $hash_tags = $this->EmailHashtags->find('all')->where(['type' => 'User'])->toArray();
            foreach ($hash_tags as $tag) {
                $content = str_replace($tag['tag'], $user_data[0][$tag['tag']], $content);
            }
        }

        $content = str_replace('#admin_panel_link#', Router::url(['controller' => 'Dashboard', 'action' => 'index', '_full' => true]), $content);

        return $content;
    }

    public function generatePassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
