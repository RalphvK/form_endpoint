<?php

    use PHPMailer\PHPMailer\PHPMailer;

    class emailService {

        /**
         * hook() method
         * default method called by the notify class' callHooks() method
         *
         * @param [array] $data - form data
         * @param [array] $formCfg - configuration from database
         * @return void
         */
        public function hook($data, $formCfg) {
            return $this->send([
                'from' => [
                    'address' => $formCfg['smtp']['from_address'],
                    'name' => $formCfg['smtp']['from_name']
                ],
                'replyTo' => [
                    [
                        'address' => $data[$formCfg['replyTo']['address_field']],
                        'name' => $data[$formCfg['replyTo']['name_field']]
                    ]
                ],
                'to' => [
                    'address' => $formCfg['to']['address'],
                    'name' => $formCfg['to']['name']
                ],
                'subject' => 'You have a new message from '.$data[$formCfg['replyTo']['name_field']],
                'html' => $this->generateHTML($data),
                'plain' => $this->generatePlain($data),
                'smtp' => $formCfg['smtp']
            ]);
        }

        public function generateHTML($data) {
            return '<pre><code>'.json_encode($data, JSON_PRETTY_PRINT).'</pre></code>';
        }

        public function generatePlain($data) {
            return json_encode($data, JSON_PRETTY_PRINT);
        }
        
        public function send($options) {
            echo environment::is('debug') ? "Sending Email" : null;

            // parse options
            $defaults = [
                'from' => [
                    'address' => $_ENV['SMTP_FROM_ADDRESS'],
                    'name' => $_ENV['SMTP_FROM_NAME']
                ],
                'replyTo' => [
                    [
                        'address' => null,
                        'name' => null
                    ]
                ],
                'to' => [
                    'address' => null,
                    'name' => null
                ],
                'subject' => 'You have a new message!',
                'html' => null,
                'plain' => null,
                'attachments' => null,
                'smtp' => [
                    'host' => $_ENV['SMTP_HOST'],
                    'port' => $_ENV['SMTP_PORT'],
                    'username' => $_ENV['SMTP_USERNAME'],
                    'password' => $_ENV['SMTP_PASSWORD']
                ]
            ];
            $options = array_merge($defaults, $options);

            // PHPMailer instance
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = $options['smtp']['host'];
            $mail->Port = $options['smtp']['port'];
            $mail->SMTPAuth = true;
            $mail->Username = $options['smtp']['username'];
            $mail->Password = $options['smtp']['password'];

            // Set who the message is to be sent from
            $mail->setFrom($options['from']['address'], $options['from']['name']);

            // Add each replyTo address
            foreach ($options['replyTo'] as $key => $entry) {
                $mail->addReplyTo($entry['address'], $entry['name']);
            }

            // Set recipient
            $mail->addAddress($options['to']['address'], $options['to']['name']);

            //Set the subject line
            $mail->Subject = $options['subject'];

            // HTML body
            $mail->msgHTML($options['html']);

            // Alternative plain-text body
            $mail->AltBody = $options['plain'];

            // Add attachments
            if (is_array($options['attachments'])) {
                foreach ($options['attachments'] as $key => $value) {
                    $mail->addAttachment($value);
                }
            } else { // if only one entry
                $mail->addAttachment($options['attachments']);
            }
            
            // Send the message, check for errors
            return $mail->send();

        }

    }

    notify::register('email', 'emailService');