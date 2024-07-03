@extends('layouts.app')

@section('content')
<h1>Create Chama</h1>
<form action="{{ route('chamas.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Chama Name" required>
    <input type="email" name="email" placeholder="Chama Email" required>
    <input type="number" name="max_members" placeholder="Max Members" required>
    
    <div id="members">
        <h2>Members</h2>
        <div class="member">
            <input type="text" name="members[0][name]" placeholder="Member Name" required>
            <input type="email" name="members[0][email]" placeholder="Member Email" required>
            <select name="members[0][role]" required>
                <option value="member">Member</option>
                <option value="treasurer">Treasurer</option>
                <option value="super_admin">Super Admin</option><br>
              
            </select>
        </div>
    </div><br>
    <button type="button" onclick="addMember()">Add Member</button><br><br><br>
    <button type="submit">Create</button>
</form>

<script>
function addMember() {
    const memberCount = document.querySelectorAll('.member').length;
    const memberDiv = document.createElement('div');
    memberDiv.className = 'member';
    memberDiv.innerHTML = `
        <input type="text" name="members[${memberCount}][name]" placeholder="Member Name" required>
        <input type="email" name="members[${memberCount}][email]" placeholder="Member Email" required>
        <select name="members[${memberCount}][role]" required>
            <option value="member">Member</option>
            <option value="treasurer">Treasurer</option>
            <option value="super_admin">Super Admin</option>
        </select>
    `;
    document.getElementById('members').appendChild(memberDiv);
}
</script>
@endsection
