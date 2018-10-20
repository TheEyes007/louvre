<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 31/07/2018
 * Time: 13:26
 */

namespace App\Form;

use App\Domain\DTO\TicketsDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

/**
 * Class TicketsType
 * @package App\Form
 */
class TicketsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array(
                'attr' => array('placeholder' => 'Nom'),
                'label' => 'Nom',))
            ->add('firstname',TextType::class, array('attr' => array('placeholder' => 'Prénom'),
                'label' => 'Prénom',))
            ->add('dateofbirth',DateType::class, array(
                'invalid_message' => 'Format de date valide de type dd/mm/YYYY',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('placeholder' => 'Date de naissance','class' => 'datepicker'),
                'label' => 'Date de naissance',
                'format' => 'dd/MM/yyyy',))
            ->add('tarif', ChoiceType::class, array(
                'choices'  => array(
                    'Normal' => 'Tarif Normal',
                    'Réduit' => 'Tarif Réduit',
                    'Demi-Journée' => 'Tarif Demi-Journée',
                ),
                'label' => 'Billets',))
            ->add('dateofbooking',DateType::class, array(
                'invalid_message' => 'Format de date valide de type dd/mm/YYYY',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('placeholder' => 'Date de réservation','class' => 'datepicker-booking'),
                'label' => 'Date de réservation',
                'format' => 'dd/MM/yyyy',))
            ->add('country', CountryType::class ,array(
                'choice_translation_locale' => 'fr',
                'label' => 'Pays',))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TicketsDTO::class,
            'empty_data' => function(FormInterface $form){
                return new TicketsDTO(
                    $form->get('name')->getData(),
                    $form->get('firstname')->getData(),
                    $form->get('dateofbirth')->getData(),
                    $form->get('tarif')->getData(),
                    $form->get('dateofbooking')->getData(),
                    $form->get('country')->getData()
                );
            }
        ));
    }
}
