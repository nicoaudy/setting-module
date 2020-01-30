<?php

namespace Modules\Setting\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Modules\Setting\Entities\UserType;
use Modules\Setting\Entities\Calendar;
use Modules\Setting\Datatables\CalendarDatatable;
use Modules\Setting\Http\Requests\Calendar\CreateRequest;
use Modules\Setting\Http\Requests\Calendar\UpdateRequest;

class CalendarController extends Controller
{
    public function index(CalendarDatatable $datatable)
    {
        $this->hasPermissionTo('view calendar');
        return $datatable->render('setting::calendar.index');
    }

    public function create()
    {
        $this->hasPermissionTo('add calendar');
        return view('setting::calendar.create', [
            'types' => UserType::all()
        ]);
    }

    public function store(CreateRequest $request)
    {
        $this->hasPermissionTo('add calendar');

        $check = Calendar::where('user_type_id', $request->user_type_id)->whereIn('year', [$request->from, $request->to])->get();

        if (count($check)) {
            flash('Calendar with user type and year exist.')->error();
            return redirect()->back();
        }

        $from = Carbon::parse($request->from.'-01-01');
        $to = Carbon::parse($request->to.'-12-31');

        for ($date = $from; $date->lte($to); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
            $daysOfWeek[] = $date->format('D');
        }

        foreach ($dates as $date) {
            if (Carbon::parse($date)->format('D') == 'Sat' || Carbon::parse($date)->format('D') == 'Sun') {
                $weekend = true;
            } else {
                $weekend = false;
            }

            Calendar::create([
                'user_type_id' => $request->user_type_id,
                'date' => $date,
                'days_of_week' => Carbon::parse($date)->format('D'),
                'year' => Carbon::parse($date)->format('Y'),
                'month' => Carbon::parse($date)->format('m'),
                'month_name' => Carbon::parse($date)->format('M'),
                'is_working_day' => $weekend == true ? false : true,
                'start_working_time' => '08:00',
                'end_working_time' => '17:00',
                'description' => $weekend == true ? 'Holiday' : 'Working Day',
            ]);
        };

        flash('Your data has been created')->success();
        return redirect()->route('setting.calendar.index');
    }

    public function show($id)
    {
        return view('setting::calendar.show');
    }

    public function edit($id)
    {
        $this->hasPermissionTo('edit calendar');
        $row = Calendar::find($id);
        return view('setting::calendar.edit', [
            'row' => $row
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->hasPermissionTo('edit calendar');
        Calendar::find($id)->update($request->all());
        flash('Your data has been updated')->success();
        return redirect()->route('setting.calendar.index');
    }

    public function destroy($id)
    {
        $this->hasPermissionTo('delete calendar');
        Calendar::find($id)->delete();
        flash('Your data has been deleted')->error();
        return redirect()->route('setting.calendar.index');
    }
}
