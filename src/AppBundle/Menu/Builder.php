<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class to build some menus for navigation.
 */
class Builder implements ContainerAwareInterface {

    use ContainerAwareTrait;

    /**
     * Build a menu for blog posts.
     * 
     * @param FactoryInterface $factory
     * @param array $options
     * @return ItemInterface
     */
    public function navMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class' => 'dropdown-menu',
        ));
        $menu->setAttribute('dropdown', true);

        $menu->addChild('book_index', array(
            'label' => 'Books',
            'route' => 'book_index',
        ));
        $menu->addChild('people_index', array(
            'label' => 'People',
            'route' => 'people_index',
        ));
        $menu->addChild('place_index', array(
            'label' => 'Places',
            'route' => 'place_index',
        ));

        $menu->addChild('divider1', array(
            'label' => '',
        ));
        $menu['divider1']->setAttributes(array(
            'role' => 'separator',
            'class' => 'divider',
        ));

        $menu->addChild('binding_index', array(
            'label' => 'Bindings',
            'route' => 'binding_index',
        ));
        $menu->addChild('genre_index', array(
            'label' => 'Genres',
            'route' => 'genre_index',
        ));
        $menu->addChild('keyword_index', array(
            'label' => 'Keywords',
            'route' => 'keyword_index',
        ));
        $menu->addChild('map_size_index', array(
            'label' => 'Map Sizes',
            'route' => 'map_size_index',
        ));
        $menu->addChild('map_type_index', array(
            'label' => 'Map Types',
            'route' => 'map_type_index',
        ));
        $menu->addChild('organization_index', array(
            'label' => 'Organizations',
            'route' => 'organization_index',
        ));
        $menu->addChild('plate_type_index', array(
            'label' => 'Plate Types',
            'route' => 'plate_type_index',
        ));
        $menu->addChild('referenced_person_index', array(
            'label' => 'Referenced People',
            'route' => 'referenced_person_index',
        ));
        $menu->addChild('referenced_place_index', array(
            'label' => 'Referenced Places',
            'route' => 'referenced_place_index',
        ));
        $menu->addChild('role_index', array(
            'label' => 'Roles',
            'route' => 'role_index',
        ));
        $menu->addChild('subject_index', array(
            'label' => 'Subjects',
            'route' => 'subject_index',
        ));
        $menu->addChild('subject_heading_index', array(
            'label' => 'Subject Headings',
            'route' => 'subject_heading_index',
        ));
        $menu->addChild('task_index', array(
            'label' => 'Tasks',
            'route' => 'task_index',
        ));

        if ($this->container->get('security.token_storage')->getToken() && $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $menu->addChild('divider', array(
                'label' => '',
            ));
            $menu['divider']->setAttributes(array(
                'role' => 'separator',
                'class' => 'divider',
            ));
            $menu->addChild('bibliographic_term_index', array(
                'label' => 'Bibliographic Terms',
                'route' => 'bibliographic_term_index',
            ));
            $menu->addChild('contribution_index', array(
                'label' => 'Contributions',
                'route' => 'contribution_index',
            ));
            $menu->addChild('digital_copy_holder_index', array(
                'label' => 'Digital Copy Holders',
                'route' => 'digital_copy_holder_index',
            ));
            $menu->addChild('other_copy_location_index', array(
                'label' => 'Other Copy Locations',
                'route' => 'other_copy_location_index',
            ));
            $menu->addChild('other_national_edition_index', array(
                'label' => 'Other National Editions',
                'route' => 'other_national_edition_index',
            ));
            $menu->addChild('supplemental_place_data_index', array(
                'label' => 'Supplemental Place Data',
                'route' => 'supplemental_place_data_index',
            ));
        }

        return $menu;
    }

}
