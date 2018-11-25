<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 31/07/2018
 * Time: 13:26
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Class AccountsType
 * @package App\Form
 */
class ContactsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array('attr' => array('placeholder' => 'Votre nom'),))
            ->add('titre',TextType::class, array('attr' => array('placeholder' => 'Titre'),))
            ->add('email',EmailType::class, array('attr' => array('placeholder' => 'Email'),))
            ->add('description',TextareaType::class, array('attr' => array('placeholder' => 'Description'),))
        ;
    }
}
