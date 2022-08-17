<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Commentary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Exception;

class CommentariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('view-commentaries'), Response::HTTP_FORBIDDEN, __('cms.authorization_error'));

        return Inertia::render('Commentaries/Index', [
            'commentaries' => Commentary::query()
                ->when(\Request::input('search'), function ($query, $search) {
                    $query->where('content_de', 'like', "%{$search}%");
                    $query->orWhere('original_language', 'like', "%{$search}%");
                    $query->orWhere('status', 'like', "%{$search}%");
                })
                ->paginate(20)
                ->withQueryString()
                ->through(fn ($commentary) => [
                    'id' => $commentary->id,
                    'content_de' => $commentary->content_de,
                    'original_language' => $commentary->original_language,
                    'status' => $commentary->status,
                ]),
            'filters' => \Request::only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('create-commentaries'), Response::HTTP_FORBIDDEN, __('cms.authorization_error'));

        return Inertia::render('Commentaries/Create', [
            'languages' => ['de', 'en', 'fr', 'it'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('create-commentaries'), Response::HTTP_FORBIDDEN, __('cms.authorization_error'));

        $this->validate($request, [
            'content_de' => 'required',
            'original_language' => 'required',
        ]);

        try {
            // create the commentary
            $commentary = Commentary::create([
                'content_de' => request('content_de'),
                'content_en' => request('content_en'),
                'content_fr' => request('content_fr'),
                'content_it' => request('content_it'),
                'suggested_citation_long' => request('suggested_citation_long'),
                'suggested_citation_short' => request('suggested_citation_short'),
                'original_language' => request('original_language'),
                'doi' => request('doi'),
            ]);

            return redirect(route('commentaries.index'))->with('success', 'Commentary created.');
        }
        catch (Exception $e) {
            return redirect(route('commentaries.index'))->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function show(Commentary $commentary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentary $commentary)
    {
        abort_if(Gate::denies('edit-commentaries'), Response::HTTP_FORBIDDEN, __('cms.authorization_error'));

        // return only pertinent fields for the commentary
        $commentaryToEdit = $commentary->only([
            'id',
            'content_de',
            'content_en',
            'content_fr',
            'content_it',
            'suggested_citation_long',
            'suggested_citation_short',
            'original_language',
            'doi'
        ]);

        return Inertia::render('Commentaries/Edit', [
            'commentary' => $commentaryToEdit,
            'languages' => ['de', 'en', 'fr', 'it'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentary $commentary)
    {
        abort_if(Gate::denies('edit-commentaries'), Response::HTTP_FORBIDDEN, __('cms.authorization_error'));
        
        $this->validate($request, [
            'content_de' => 'required',
            'original_language' => 'required',
        ]);

        try {
            $commentary->update([
                'content_de' => request('content_de'),
                'content_en' => request('content_en'),
                'content_fr' => request('content_fr'),
                'content_it' => request('content_it'),
                'suggested_citation_long' => request('suggested_citation_long'),
                'suggested_citation_short' => request('suggested_citation_short'),
                'original_language' => request('original_language'),
                'doi' => request('doi'),
            ]);

            return redirect(route('commentaries.edit', $commentary->id))->with('success', 'Commentary updated.');
        }
        catch (Exception $e) {
            return redirect(route('commentaries.edit', $commentary->id))->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentary $commentary)
    {
        abort_if(Gate::denies('delete-commentaries'), Response::HTTP_FORBIDDEN, __('cms.authorization_error'));

        try {
            $commentary->delete();

            return redirect(route('commentaries.index'))->with('success', 'Commentary deleted.');
        }
        catch (Exception $e) {
            return redirect(route('commentaries.index'))->with('error', $e->getMessage());
        }
    }
}
