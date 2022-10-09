// custom method used to show a field only to super users and users assigned with a specific role
Statamic.$conditions.add('role', ({ params }) => Statamic.user.super || params.filter(param => Statamic.user.roles.includes(param)).length > 0)

// custom method used to show a field only to super users and users assigned to a specific group
Statamic.$conditions.add('group', ({ params }) => Statamic.user.super || params.filter(param => Statamic.user.groups.includes(param)).length > 0)