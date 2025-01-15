# DATABASES
This file is made to leave written how Databases work in Laravel

## Migrations
Migrations are a way to manipulate databases, acting as versions controller that a group of devs making a project can get changes from local changes.

### Common Commands for Migrations

**Create Migration:**
```BASH
php artisan make:migration create_{TABLE NAME}_table
```

**Add a column:**
```BASH
php artisan make:migration add_{COLUMN NAME}_to_{TABLE NAME}_table
```

**Change a column's properties:**
```BASH
php artisan make:migration change_properties_to_{TABLE NAME}_table
```

**Roll a migration back:**
```BASH
php artisan migrate:rollback
```

**_Refresh_ database<sup>1</sup>:**
```BASH
php artisan migrate:fresh
```

**_Refresh_ database<sup>2</sup>:**
```BASH
php artisan migrate:refresh
```

> [!WARNING]  
> Both **fresh** and **refresh** are destructive commands that erase all data in the DB with the following diference: refresh removes all data from the migrations with a `down()` method and fresh removes everything regardless of the abscence of a `down()` method.

**Seed a database:**
```BASH
php artisan migrate:fresh --seed
```


## Eloquent
Eloquent is a database tool for DML queries (Read, Create, Update, Delete, etc...)

## Conventions for Eloquent
1. Controller
    - Must follow the following naming pattern: `{Class}Controller`

2. Model
    - Databases must be called in plural. `i.e pets`
    - Models must be called in singular. `i.e Pet`

**create controller:**
```BASH
php artisan make:controller {NAME}Controller
```

**create model:**
```BASH
# assuming the table will be called 'articles'
php artisan make:model Article

# assuming the table will be called 'echoes'
php artisan make:model Echo
```

## Seeder
Seeders are in charge of filling our databases with fake registers to have a base material to work with.

**Create a seeder:**
```BASH
php artisan make:seeder {NAME}Seeder
```

## Factory
Factories are the file where our fake registers are created with a schema so they're sent by the seeders to the database.

**Create a factory:**
```BASH
php artisan make:factory {NAME}Factory
```

## Tinker
Tinker is a query tool which helps us simulate our queries to a database by following `Eloquent` conventions.

### Using Tinker
Type in your console the following command and you'll be sent to the Tinker console:

```BASH
php artisan tinker
```

**Exiting Tinker console:**
```TINKER
exit
```

**Using a model:**
```TINKER
use App\Models\Pet
```

**Creating a register:**
```TINKER
# instanciating a new object
>> $pet = new Pet()

# filling it with info
>> $pet->type = 'Cat'
>> $pet->race = 'Siames'
>> $pet->color = 'white'
>> $pet->age = 2
>> $pet->vaccinated = 1

# sending it to the database
>> $pet->save()
```

**Updating information from an instanciated object:**
```TINKER
# updating the info in the instanciated object
>> $pet->color = 'orange'

# saving it in the DB
>> $pet->save()
```

**Getting all registers from a table:**
```TINKER
>> $pets = Pet:all()
```

**Getting registers with WHERE parameters:**
```TINKER
>> $pets = Pet::where('type', 'Cat')->get()
```

**Filtering fetched registers:**
```TINKER
>> $pets = Pet::where('type', 'Cat')->orderBy('type', 'asc')->get()
```

**Selecting columns from the database:**
```TINKER
>> $pets = Pet::select('type', 'color')->get()
```

**Selecting register with conditions:**
```TINKER
>> $pets = Pet::where('race', 'like', '% jungle %')
```

> **%** allows you to find a register that contains a specific string parameter