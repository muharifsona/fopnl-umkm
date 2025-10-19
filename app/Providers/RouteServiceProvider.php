use App\Models\ProductIngredient;
use Illuminate\Support\Facades\Route;

public function boot(): void
{
    parent::boot();

    // 👇 Tambahkan ini
    Route::model('productIngredient', ProductIngredient::class);
}
