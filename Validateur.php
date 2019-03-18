<?php
class Validateur{
private $params;
private $erreur= [];
private $message =[
    'minlength' => "le champ %s requis minimum %d caractères ",
    'maxlength' => "le champ %s requis maximum %d caractères ",
    'email' => "Le champ %s doit être un email valide"
];


    public function __construct($params)
    {
        $this->params = $params;
    }




   /** Mes methodes privées */



   private function has($field)
   {
       return array_key_exists($field, $this->params);
   }

   private function addErreur($rule, $field, $option = null)
   {
    $this->erreur[$field][] = sprintf($this->message[$rule], $field, $option);
   }


   /** Mes méthodes publics */


     /** on vérifie que l'utilisateur rentre bien un pseudo avec plus de 5 caractères */
   public function minlength(string $field, int $nbrmin = 5)
   {
      if($this->has($field)){
          if(mb_strlen($this->params[$field]) <= $nbrmin){
           $this->addErreur('minlength', $field, $nbrmin);
          }
      }
      return $this;
   }
  /** on vérifie que l'utilisateur rentre bien un pseudo moins de 20 caractères */
   public function maxlength(string $field, int $nbrmax = 20)
   {
    if($this->has($field)){
        if(mb_strlen($this->params[$field]) >= $nbrmax){
         $this->addErreur('maxlength', $field, $nbrmax);
        }
    }
    return $this;
   }
   /** on vérifie que l'utilisateur rentre bien un email valide */
   public function email($field)
   {
        if($this->has($field)){
            if(!filter_var($this->params[$field], FILTER_VALIDATE_EMAIL)){
                $this->addErreur('email', $field);
            }
        }
   }
   /** on retounre l'erreur */
   public function getErreur()
   {
      return $this->erreur;
   }
}

?>