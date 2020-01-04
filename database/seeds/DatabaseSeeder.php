<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'mobile' => "9028285332",
            'email' => 'aamirkazi47@gmail.com',
            'name' => 'Super Admin',
            'password' => bcrypt('afqami'),
            'city' => 'pune',
            'state' => 'maharashtra',
            'address' => '',
            'activation_code' => '',
            'user_status' => '1',
            'user_type' => '1',
        ]);


//        Insert Global values table data

        $global_values['name'] = ['contact','site email','facebook link','twiter link','site title','google plus','Site Logo'];
        $global_values['slug'] = ['contact','site-email','facebook','twitter','site-title','google-plus','site-logo'];
        $global_values['value'] = ['9028285332','aamir@mail.com','www.facebook.com','twitter.com','Afqami','plus.google.com',''];

        foreach ($global_values['name'] as $index => $name)
        {
            DB::table('global_values')->insert(['name'=>$name,'slug'=>$global_values['slug'][$index],'value'=>$global_values['value'][$index]]);
        }


        //insert permissions table data
        $permission['module_name'] = ['Global Values','Global Values','Standards','Standards','Standards','Standards','Roles','Roles','Roles','Roles','Roles','Competitive Exams','Competitive Exams','Competitive Exams','Competitive Exams','Boards','Boards','Boards','Boards','Users','Users','Users','Users','Email Templates','Email Templates','Cms','Cms','Contact Us','Contact Us','Faqs','Faqs','Faqs','Faqs'];
        $permission['permission'] = ['View Global Values','Update Global Values','View Standards','Create Standards','Update Standards','Delete Standards','View Roles','Create Roles','Update Roles','Delete Roles','Set Permissions','View Exams','Create Exams','Update Exams','Delete Exams','View Boards','Create Boards','Update Boards','Delete Boards','View Users','Create Users','Update Users','Delete Users','View Email Templates','Update Email Templates','View Cms','Update Cms','View Contact Us','ReplyContact Us','View Faqs','Create Faqs','Update Faqs','Delete Faqs'];
        $permission['slug'] = ['view.global.values','update.global.values','view.standards','create.standards','update.standards','delete.standards','view.roles','create.roles','update.roles','delete.roles','set.permissions','view.exams','create.exams','update.exams','delete.exams','view.boards','create.boards','update.boards','delete.boards','view.users','create.users','update.users','delete.users','view.emailtemplates','update.emailtemplates','view.cms','update.cms','view.contactus','reply.contactus','view.faqs','create.faqs','update.faqs','delete.faqs'];

        foreach ($permission['module_name'] as $index => $module_name)
        {
            DB::table('permissions')->insert(['module_name'=>$module_name,'slug'=>$permission['slug'][$index],'permission'=>$permission['permission'][$index]]);
        }

        //insert email template data
        $email_tamplate['name'] = ['Registration Successful','Contact Us Thanks','Contact Us Reply'];
        $email_tamplate['subject'] = ['Registration Successful','Contact Us','Contact Us Reply'];
        $email_tamplate['template_key'] = ['registration-successful','contact-us-thanks','contact-us-reply'];
        $email_tamplate['validate'] = ['required','required','required'];
        $email_tamplate['parameter'] = ['{{$USER_NAME}},{{$SITE_EMAIL}},{{$SITE_TITLE}}','{{$USER_NAME}},{{$SITE_EMAIL}},{{$SITE_TITLE}}','{{$SITE_EMAIL}},{{$SITE_TITLE}},{{$MESSAGE}}'];

        foreach ($email_tamplate['name'] as $index => $name)
        {
            DB::table('email_template')->insert(['name'=>$name,'value'=>'','parameter'=>$email_tamplate['parameter'][$index],'validate'=>$email_tamplate['validate'][$index],'subject'=>$email_tamplate['subject'][$index],'template_key'=>$email_tamplate['template_key'][$index]]);
        }
    }
}
