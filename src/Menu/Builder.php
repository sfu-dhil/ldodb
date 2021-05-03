<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class to build some menus for navigation.
 */
class Builder implements ContainerAwareInterface {
    use ContainerAwareTrait;

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authChecker;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authChecker, TokenStorageInterface $tokenStorage) {
        $this->factory = $factory;
        $this->authChecker = $authChecker;
        $this->tokenStorage = $tokenStorage;
    }

    private function hasRole($role) {
        if ( ! $this->tokenStorage->getToken()) {
            return false;
        }

        return $this->authChecker->isGranted($role);
    }

    /**
     * Build a menu for blog posts.
     *
     * @return ItemInterface
     */
    public function mainMenu(array $options) {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes([
            'class' => 'nav navbar-nav',
        ]);

        $browse = $menu->addChild('browse', [
            'label' => 'Browse',
            'uri' => '#',
        ]);
        $browse->setAttribute('dropdown', true);
        $browse->setLinkAttribute('class', 'dropdown-toggle');
        $browse->setLinkAttribute('data-toggle', 'dropdown');
        $browse->setChildrenAttribute('class', 'dropdown-menu');

        $browse->addChild('book_index', [
            'label' => 'Titles',
            'route' => 'book_index',
        ]);
        $browse->addChild('people_index', [
            'label' => 'Persons',
            'route' => 'people_index',
        ]);
        $browse->addChild('place_index', [
            'label' => 'Places',
            'route' => 'place_index',
        ]);

        $browse->addChild('divider1', [
            'label' => '',
        ]);
        $browse['divider1']->setAttributes([
            'role' => 'separator',
            'class' => 'divider',
        ]);

        $browse->addChild('genre_index', [
            'label' => 'Genre',
            'route' => 'genre_index',
        ]);
        $browse->addChild('keyword_index', [
            'label' => 'Keyword',
            'route' => 'keyword_index',
        ]);
        $browse->addChild('subject_index', [
            'label' => 'Subjects',
            'route' => 'subject_index',
        ]);

        if ($this->hasRole('ROLE_CONTENT_ADMIN')) {
            $browse->addChild('divider', [
                'label' => '',
            ]);
            $browse['divider']->setAttributes([
                'role' => 'separator',
                'class' => 'divider',
            ]);

            $browse->addChild('admin_only', [
                'label' => '<b>Administrators</b>',
                'uri' => '#',
                'class' => 'disabled',
                'extras' => ['safe_label' => true],
            ]);

            $browse->addChild('bibliographic_term_index', [
                'label' => 'Bibliographic Terms',
                'route' => 'bibliographic_terms_index',
            ]);
            $browse->addChild('binding_index', [
                'label' => 'Binding Features',
                'route' => 'binding_feature_index',
            ]);
            $browse->addChild('digital_copy_holder_index', [
                'label' => 'Digital Copy Holders',
                'route' => 'digital_copy_holder_index',
            ]);

            $browse->addChild('features', [
                'label' => 'Features',
                'route' => 'homepage_features',
            ]);
            $browse->addChild('map_size_index', [
                'label' => 'Map Sizes',
                'route' => 'map_size_index',
            ]);
            $browse->addChild('map_type_index', [
                'label' => 'Map Types',
                'route' => 'map_type_index',
            ]);
            $browse->addChild('organization_index', [
                'label' => 'Organizations',
                'route' => 'organization_index',
            ]);
            $browse->addChild('other_copy_location_index', [
                'label' => 'Other Copy Locations',
                'route' => 'other_copy_location_index',
            ]);
            $browse->addChild('other_national_edition_index', [
                'label' => 'Other National Editions',
                'route' => 'other_national_edition_index',
            ]);
            $browse->addChild('plate_type_index', [
                'label' => 'Plate Types',
                'route' => 'plate_type_index',
            ]);
            $browse->addChild('referenced_person_index', [
                'label' => 'Referenced People',
                'route' => 'referenced_person_index',
            ]);
            $browse->addChild('referenced_place_index', [
                'label' => 'Referenced Places',
                'route' => 'referenced_place_index',
            ]);
            $browse->addChild('role_index', [
                'label' => 'Roles',
                'route' => 'role_index',
            ]);
            $browse->addChild('subject_heading_index', [
                'label' => 'Subject Headings',
                'route' => 'subject_heading_index',
            ]);
            $browse->addChild('supplemental_place_data_index', [
                'label' => 'Supplemental Place Data',
                'route' => 'supplemental_place_data_index',
            ]);
            $browse->addChild('task_index', [
                'label' => 'Tasks',
                'route' => 'task_index',
            ]);
        }

        return $menu;
    }
}
