
public function index()
{
    $adminUsers = User::where('usertype', 'admin')->get();
    // Pass other necessary data to the view
    return view('vendor.Chatify.layouts.listItem', compact('adminUsers', 'otherData'));
}