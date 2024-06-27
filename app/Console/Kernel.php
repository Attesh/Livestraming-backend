<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Section;
use App\Models\User;
use App\Jobs\SendCourseReminderEmail;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    //  protected function schedule(Schedule $schedule)
    //  {
    //      $sections = Section::where('status', 1)
    //                         ->where('user_id', '45570') // Adjust the user ID as needed
    //                         ->orderBy('created_at', 'desc')
    //                         ->get();
     
    //      foreach ($sections as $section) {
    //          $user = User::find($section->user_id);
    //          $startDate = $section->created_at;
    //          $todayDate = Carbon::now();
    //          $noOfDays = $todayDate->diffInDays($startDate);
     
    //          // Log the scheduling for debugging
    //          \Log::info('Scheduling reminders for user: ' . $user->id . ' starting at: ' . $startDate);
     
    //          $schedule->call(function () use ($user, $noOfDays) {
    //              if ($noOfDays == 1) {
    //                  \Log::info('Scheduling Reminder 1 for user: ' . $user->id);
    //                  SendCourseReminderEmail::dispatch($user, 1);
    //              } elseif ($noOfDays == 3) {
    //                  \Log::info('Scheduling Reminder 2 for user: ' . $user->id);
    //                  SendCourseReminderEmail::dispatch($user, 2);
    //              } elseif ($noOfDays == 7) {
    //                  \Log::info('Scheduling Reminder 3 for user: ' . $user->id);
    //                  SendCourseReminderEmail::dispatch($user, 3);
    //              } elseif ($noOfDays == 14) {
    //                  \Log::info('Scheduling Reminder 4 for user: ' . $user->id);
    //                  SendCourseReminderEmail::dispatch($user, 4);
    //              }else{
    //                 \Log::info('Scheduling Reminder 1 for user: ' . $user->id);
    //                  SendCourseReminderEmail::dispatch($user, 1);
    //              }
    //          })->everyMinute(); // Run this check every minute
    //      }
    //  }
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    
        $sections = Section::where('status', 1)
                           ->orderBy('created_at', 'desc')
                           ->take(30)
                           ->get();
    
        foreach ($sections as $section) {
            $user = User::find($section->user_id);
            $startDate = $section->created_at;
            
           
            $schedule->job(new SendCourseReminderEmail($user, 1));
        // $schedule->job(new SendCourseReminderEmail($user, 2));
        // $schedule->job(new SendCourseReminderEmail($user, 3));
        // $schedule->job(new SendCourseReminderEmail($user, 4));
            // Define the jobs with different delays
            // $schedule->job((new SendCourseReminderEmail($user, 1))->delay($startDate->copy()->addDay(1)));
            // $schedule->job((new SendCourseReminderEmail($user, 2))->delay($startDate->copy()->addDay(3)));
            // $schedule->job((new SendCourseReminderEmail($user, 3))->delay($startDate->copy()->addDay(7)));
            // $schedule->job((new SendCourseReminderEmail($user, 4))->delay($startDate->copy()->addDay(14)));
        }
    }
    
    
    


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
