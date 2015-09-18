<?php
namespace Acme\AccountBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mobile', 'number',
            [
                'label' => false,
                'attr'  => ['placeholder' => '手机号码']
            ]
        );
        $builder->add('email', 'email',
            [
                'label' => false,
                'attr'  => ['placeholder' => '电子邮箱']
            ]
            );
        $builder->add('username', 'text',
            [
                'label' => false,
                'attr' => ['placeholder'=> '登录帐号']
            ]
        );
        $builder->add('注册', 'submit',
            [
                'label' => false,
            ]
            );
        $builder
            ->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => false, 'attr'=>['placeholder'=>'登录密码']),
            'second_options' => array('label' => false, 'attr'=>['placeholder'=>'确认登录密码']),
            'invalid_message' => '两次密码输入不相同',
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}