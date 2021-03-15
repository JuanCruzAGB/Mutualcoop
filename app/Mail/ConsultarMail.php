<?php
    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class ConsultarMail extends Mailable{
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
            $id_suscriptor = $this->data->id_suscriptor;
            $nombre = 'Suscriptor: ' . $id_suscriptor;
            $asunto = "Consulta Suscriptor: ID $id_suscriptor";
            return $this->view('correo.consulta')
                ->from('info@mutualcoop.org.ar', 'Mutualcoop Web')
                ->subject($asunto);
        }
    }