<?php
/**
 * Copyright 2019 Luis Alberto Pabón Flores
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

namespace App\Generator\Form;

use App\Generator\Entity\Project;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Project forms.
 *
 * @package App\Form\Generator
 * @author  Luis A. Pabon Flores
 */
class ProjectType extends AbstractGeneratorType
{
    /**
     * Builds the form definition.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'      => 'Project name',
                'attr'       => ['placeholder' => 'Used on host, container, vm and folder names'],
                'empty_data' => '',
            ])
            ->add('basePort', IntegerType::class, [
                'label' => 'Base port',
                'attr'  => ['placeholder' => 'Ports exposed on the different services will start at this port number'],
            ])
//            ->add('hasMemcached', CheckboxType::class, [
//                'required' => false,
//                'label'    => 'Enable Memcached',
//            ])
//            ->add('hasRedis', CheckboxType::class, [
//                'required' => false,
//                'label'    => 'Enable Redis',
//            ])
//            ->add('hasMailhog', CheckboxType::class, [
//                'required' => false,
//                'label'    => 'Enable Mailhog',
//            ])
//            ->add('hasClickhouse', CheckboxType::class, [
//                'required' => false,
//                'label'    => 'Enable Clickhouse',
//            ])
//            ->add('phpOptions', PhpType::class, ['label' => 'PHP Options'])
//            ->add('mysqlOptions', MySQLType::class, ['label' => 'MySQL'])
//            ->add('mariadbOptions', MariaDBType::class, ['label' => 'MariaDB'])
//            ->add('postgresOptions', PostgresType::class, ['label' => 'Postgres'])
            ->add('applicationOptions', ApplicationType::class, ['label' => 'Application options'])
//            ->add('elasticsearchOptions', ElasticsearchType::class, ['label' => 'Elasticsearch']);

        ;
    }

    /**
     * This should return a string with the FQDN of the entity class associated to this form.
     *
     * @return string
     */
    protected function getDataClass(): string
    {
        return Project::class;
    }
}