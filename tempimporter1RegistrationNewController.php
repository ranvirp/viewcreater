<?php
 Yii::import('application.modules.user.controllers.*');
 class tempimporter1RegistrationNewController extends RegistrationController{
 public function actionRegistration() 
 {
  $model = new RegistrationForm;
            $profile=new Profile;
           
    
	 $this->render('/Registration/user/registration',array('model'=>$model,'profile'=>$profile));
		  
	}
 }

?>