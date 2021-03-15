<?php
    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class ConfirmarMail extends Mailable{
        use Queueable, SerializesModels;

        /** @var array Los datos que el usuario envia por el formulario. */
        public $data;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($inputData){
            $this->data = $inputData;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build(){
            $correo = $this->data->correo;
            $nombre = $this->data->nombre;
            $asunto = "¡Te registraste en Mutualcoop! Por favor confirme su correo electrónico";
            return $this->view('correo.confirmar')
                ->from('info@mutualcoop.org.ar', 'Mutualcoop')
                ->subject($asunto);
        }
    }