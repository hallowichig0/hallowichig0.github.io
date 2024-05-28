<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FieldFrontpage extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $FieldFrontpage = new FieldsBuilder('sections', [
            'key' => 'frontpage',
            'position' => 'acf_after_title',
            'menu_order' => 0,
            'label_placement' => 'top',
            'style' => 'default',
            'active' => true,
            'show_in_rest' => 1,
        ]);

        $FieldFrontpage
            ->setLocation('page_type', '==', 'front_page');

        $FieldFrontpage
            ->addAccordion('frontpage_accordion_section1', [
                'label' => 'Section 1',
                'instructions'  => '',
                'required'  => 0,
                'wrapper'   => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'open'  => 0,
                'multi_expand'  => 0,
                'endpoint'  => 0,
            ])
            ->addText('frontpage_section1_title_field', [
                'label' => 'Title',
                'required'  => 1,
                'maxlength' => '15',
            ])
            ->addText('frontpage_section1_subtitle_field', [
                'label' => 'Subtitle',
                'required'  => 1,
                'maxlength' => '12',
            ])
            ->addRepeater('frontpage_section1_typewriter_field', [
                'label' => 'Typewriter List',
                'layout'    => 'block',
                'required'  => 1,
                'min'   => '',
                'max'   => '3',
                'button_label'  => 'Add Typewriter',
            ])
                ->addText('frontpage_section1_typewriter_subfield1', [
                    'label' => 'Typewrite',
                    'required'  => 1,
                    'maxlength' => '25',
                ])
                ->endRepeater()
            ->addTextArea('frontpage_section1_description_field', [
                'label' => 'Description',
                'required'  => 1,
                'maxlength' => '125',
            ])
            ->addImage('frontpage_section1_profileIcon_field', [
                'label' => 'Image',
                'instructions'  => 'Recommended image size (600x600)',
                'required'  => 1,
                'mime_types' => '.jpg, .png, .jpeg',
            ])
            ->addRepeater('frontpage_section1_highlightSkills_field', [
                'label' => 'Image/Video Slider',
                'layout'    => 'block',
                'required'  => 1,
                'min'   => '',
                'max'   => '3',
                'button_label'  => 'Add Image',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'frontpage_section1_profileIcon_subfield1',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ])
                ->addImage('frontpage_section1_highlightSkills_subfield1', [
                    'label' => 'Image',
                    'instructions'  => 'Recommended image size (70x70)',
                    'required'  => 1,
                    'mime_types' => '.jpg, .png, .jpeg',
                ])
                ->endRepeater()
            ->addNumber('frontpage_section1_completeProject_field', [
                'label' => 'Section Title',
                'required'  => 1,
                'min' => '1',
                'max' => '1000',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'frontpage_section1_profileIcon_subfield1',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ]);

        $FieldFrontpage
            ->addAccordion('frontpage_accordion_section2', [
                'label' => 'Section 2',
                'instructions'  => '',
                'required'  => 0,
                'wrapper'   => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'open'  => 0,
                'multi_expand'  => 0,
                'endpoint'  => 0,
            ])
            ->addNumber('frontpage_section2_yearsExperience_field', [
                'label' => 'Years of experience',
                'required'  => 1,
                'min' => '1',
                'max' => '100',
            ])
            ->addNumber('frontpage_section2_clientSatisfaction_field', [
                'label' => 'Clients Satisfaction Percentage',
                'instructions'  => 'Up to 100%',
                'required'  => 1,
                'min' => '1',
                'max' => '100',
            ])
            ->addRepeater('frontpage_section2_skills_field', [
                'label' => 'Skills',
                'layout'    => 'block',
                'required'  => 1,
                'min'   => '',
                'max'   => '',
                'button_label'  => 'Add Skill',
            ])
                ->addText('frontpage_section1_skills_subfield1', [
                    'label' => 'Skill',
                    'required'  => 1,
                    'maxlength' => '12',
                ])
                ->addNumber('frontpage_section1_skills_subfield2', [
                    'label' => 'Percentage of skill',
                    'instructions'  => 'Up to 100%',
                    'required'  => 1,
                    'min' => '1',
                    'max' => '100',
                ])
                ->addSelect('frontpage_section1_skills_subfield3', [
                    'label' => 'Grid Color',
                    'instructions' => '',
                    'required' => 1,
                    'choices' => array(
                        'blue' => 'Blue',
                        'red' => 'Red',
                        'yellow' => 'Yellow',
                        'green' => 'Green',
                        'violet' => 'Violet',
                    ),
                    'default_value' => 'blue',
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ])
                ->endRepeater();

        $FieldFrontpage
            ->addAccordion('frontpage_accordion_section3', [
                'label' => 'Section 3',
                'instructions'  => '',
                'required'  => 0,
                'wrapper'   => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'open'  => 0,
                'multi_expand'  => 0,
                'endpoint'  => 0,
            ])
            ->addRepeater('frontpage_section3_services_field', [
                'label' => 'Services',
                'layout'    => 'block',
                'required'  => 1,
                'min'   => '',
                'max'   => '3',
                'button_label'  => 'Add Service',
            ])
                ->addText('frontpage_section3_services_subfield1', [
                    'label' => 'Tab Title',
                    'required'  => 1,
                    'maxlength' => '15',
                ])
                ->addRepeater('frontpage_section3_services_subfield2', [
                    'label' => 'Type of Service',
                    'layout'    => 'block',
                    'required'  => 1,
                    'min'   => '',
                    'max'   => '3',
                    'button_label'  => 'Add Type of Service',
                ])
                    ->addText('frontpage_section3_services_subfield2_title', [
                        'label' => 'Tab Title',
                        'required'  => 1,
                        'maxlength' => '20',
                    ])
                    ->addSelect('frontpage_section3_services_subfield2_icon', [
                        'label' => 'Icon',
                        'instructions' => '',
                        'required' => 1,
                        'choices' => array(
                            'flaticon-coding' => 'Coding',
                            'flaticon-app-development' => 'Mobile Development',
                            'flaticon-smartphone' => 'Smartphone',
                            'flaticon-social-media' => 'Social Media',
                        ),
                        'default_value' => 'flaticon-coding',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                    ])
                    ->endRepeater()
                ->endRepeater();

        $FieldFrontpage
            ->addAccordion('frontpage_accordion_section4', [
                'label' => 'Section 4',
                'instructions'  => '',
                'required'  => 0,
                'wrapper'   => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'open'  => 0,
                'multi_expand'  => 0,
                'endpoint'  => 0,
            ])
            ->addRepeater('frontpage_section4_experiences_field', [
                'label' => 'Experiences',
                'layout'    => 'block',
                'required'  => 1,
                'min'   => '',
                'max'   => '',
                'button_label'  => 'Add Experience',
            ])
                ->addSelect('frontpage_section4_experiences_subfield1', [
                    'label' => 'Start Year',
                    'instructions' => '',
                    'required' => 1,
                    'choices' => array(),
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ])
                ->addSelect('frontpage_section4_experiences_subfield2', [
                    'label' => 'End Year',
                    'instructions' => '',
                    'required' => 1,
                    'choices' => array(),
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'frontpage_section4_experiences_subfield3',
                                'operator' => '==',
                                'value' => 0,
                            ),
                        ),
                    ),
                ])
                ->addTrueFalse('frontpage_section4_experiences_subfield3', [
                    'label' => 'End Date Present?',
                    'required'  => 0,
                ])
                ->addText('frontpage_section4_experiences_subfield4', [
                    'label' => 'Position Title',
                    'required'  => 1,
                    'maxlength' => '35',
                ])
                ->addText('frontpage_section4_experiences_subfield5', [
                    'label' => 'Company Name',
                    'required'  => 1,
                    'maxlength' => '70',
                ])
                ->addText('frontpage_section4_experiences_subfield6', [
                    'label' => 'Workfrom?',
                    'required'  => 0,
                    'maxlength' => '25',
                ])
                ->addUrl('frontpage_section4_experiences_subfield7', [
                    'label' => 'Company URL',
                    'required'  => 0,
                ])
                ->endRepeater();

        $FieldFrontpage
            ->addAccordion('frontpage_accordion_section5', [
                'label' => 'Section 5',
                'instructions'  => '',
                'required'  => 0,
                'wrapper'   => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'open'  => 0,
                'multi_expand'  => 0,
                'endpoint'  => 0,
            ])
            ->addRepeater('frontpage_section5_portfolios_field', [
                'label' => 'Portfolio',
                'layout'    => 'block',
                'required'  => 1,
                'min'   => '',
                'max'   => '',
                'button_label'  => 'Add Portfolio',
            ])
                ->addSelect('frontpage_section5_portfolios_type', [
                    'label' => 'Type',
                    'required' => 1,
                    'choices' => [
                        'wordpress' => 'Wordpress',
                        'drupal' => 'Drupal',
                    ],
                    'default_value' => 'wordpress',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'label',
                ])
                ->addImage('frontpage_section5_portfolios_subfield1', [
                    'label' => 'Image',
                    'instructions'  => 'Recommended image size (413x413)',
                    'required'  => 1,
                    'mime_types' => '.jpg, .png, .jpeg',
                ])
                ->addText('frontpage_section5_portfolios_subfield2', [
                    'label' => 'Portfolio Name',
                    'required'  => 1,
                    'maxlength' => '35',
                ])
                ->addText('frontpage_section5_portfolios_subfield3', [
                    'label' => 'Skill Stack',
                    'required'  => 1,
                    'maxlength' => '40',
                ])
                ->addText('frontpage_section5_portfolios_associate_with', [
                    'label' => 'Associate with?',
                ])
                ->addUrl('frontpage_section5_portfolios_subfield4', [
                    'label' => 'Portfolio URL',
                    'required'  => 1,
                ])
            ->endRepeater();

        $FieldFrontpage
            ->addAccordion('frontpage_accordion_section6', [
                'label' => 'Section 6',
                'instructions'  => '',
                'required'  => 0,
                'wrapper'   => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'open'  => 0,
                'multi_expand'  => 0,
                'endpoint'  => 0,
            ])
            ->addText('frontpage_section6_contactus_subfield1', [
                'label' => 'Email',
                'required'  => 1,
                'maxlength' => '45',
            ])
            ->addText('frontpage_section6_contactus_subfield2', [
                'label' => 'Phone No.',
                'required'  => 1,
                'maxlength' => '25',
            ]);

        return $FieldFrontpage->build();
    }
}
