<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configurations extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'description',
        'type',
        'group'
    ];

    public static function getValue(string $name, bool $failover = false): ?string
    {
        $config = Configurations::where('name', $name)->first();
        if ($config) {
            return $config->value;
        }
        if ($failover) {
            return $failover;
        }
        return  null;
    }

    public static function updateValue(string $name, string $value): bool
    {
        $config = Configurations::where('name', $name)->first();
        if ($config) {
            $config->value = $value;
            $config->save();
            return true;
        }
        return Configurations::create([
            'name' => $name,
            'value' => $value
        ]);
    }

    public static function getValueById(int $id): ?string
    {
        $config = Configurations::where('id_configuration', $id)->first();
        if ($config) {
            return $config->value;
        }
        return null;
    }
}
