<?php
use Migrations\AbstractMigration;

class AddIdentifierToUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');

        $table->addColumn('identifier', 'string', [
            'default' => null,
            'limit' => 36,
            'null' => false,
        ]);

        $table->update();
    }
}
