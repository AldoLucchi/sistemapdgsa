if ($request->hasFile('%FIELD%_file')) {
$archivo = $request->file('%FIELD%_file');
$nombreArchivo = $this->functionsService->getCustomFilename('%OBJETO%', $archivo->getClientOriginalName(), $request->name);
Storage::disk('images')->put($nombreArchivo, File::get($archivo));
$request['%FIELD%'] = $nombreArchivo;
}