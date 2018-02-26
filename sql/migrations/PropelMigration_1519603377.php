<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1519603377.
 * Generated on 2018-02-25 21:02:57 by renan
 */
class PropelMigration_1519603377
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
            'default' => "INSERT INTO palavra (palavra) VALUES 
                            ('')
                            ,('con-for-to')
                            ,('a-ten-di-men-to')
                            ,('bem-es-tar')
                            ,('cre-di-bi-li-da-de')
                            ,('con-ce-i-to')
                            ,('ves-tir-se')
                            ,('con-fi-an-ça')
                            ,('fi-de-li-da-de')
                            ,('se-gu-ran-ça')
                            ,('mo-der-na')
                            ,('es-ti-lo')
                            ,('ex-clu-si-vi-da-de')
                            ,('va-ri-e-da-de')
                            ,('mu-lher');
        ");
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array ('default' => 'DELETE FROM palavra;');
    }

}