<?php
use Migrations\AbstractMigration;

class AddAdminConfirmedToUsers extends AbstractMigration
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
        $table->addColumn('admin_confirmed', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ]);
        $table->update();
    }
}
